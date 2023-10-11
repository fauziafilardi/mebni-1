<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if ($user->role == 1) {
                return ($next($request));
            } else {
                return redirect()->route('home');
            };
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select(DB::raw("
            id,
            CASE
                WHEN membership_type = 'C' THEN 'Company'
                WHEN membership_type = 'P' THEN 'Personal'
                WHEN membership_type = 'I' THEN 'Internal'
                ELSE '-'
            END as membership_type,
            name,
            phone_number,
            address,
            contact_person,
            contact_person_phone_number,
            occupation,
            is_agree,
            email,
            password,
            email_verified_at,
            photo_profile,
            last_login,
            user_ip,
            is_logged_in,
            is_active,
            is_verified,
            CASE
                WHEN role = 1 THEN 'Super Admin'
                WHEN role = 2 THEN 'Petugas'
                WHEN role = 3 THEN 'Member'
                ELSE '-'
            END as role
        "))
        ->get();

        return view('backend.users.index', ['users' => $users]);
    }

    public function get_data_users(Request $request)
    {
        // Get the pagination and sorting parameters from the request
        $page = $request->input('pagination.page', 1);  // Default to page 1
        $perPage = $request->input('pagination.perpage', 10);  // Default to 10 items per page

        // Check if the sorting parameters exist, if not default to 'id' and 'desc'
        $sortField = $request->input('sort.field', 'id');
        $sortOrder = $request->input('sort.sort', 'desc');

        // Get the search query
        $searchQuery = $request->input('query.generalSearch', '');

        // Build the query dynamically based on the parameters
        $query = User::query();

        // Apply search query
        if (!empty($searchQuery)) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
            // You can add more conditions for other fields as needed
        }

        // If sortField and sortOrder exist, then sort the query
        if ($sortField && $sortOrder) {
            $query->orderBy($sortField, $sortOrder);
        }

        // Execute the query with pagination
        $users = $query->paginate($perPage, ['*'], 'page', $page);

        // Return the paginated results as a JSON response
        return response()->json($users);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'phone_number' => 'required|unique:users|max:20',
                'address' => 'required|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $trans = DB::transaction(function () use ($request) {
                $user = Auth::user();

                $is_active = $request->is_active == 'on' ? 1 : 0;
                $is_verified = $request->is_verified == 'on' ? 1 : 0;

                $input['membership_type'] = 'I';
                $input['name'] = $request->name;
                $input['phone_number'] = $request->phone_number;
                $input['address'] = $request->address;
                $input['email'] = $request->email;
                $input['password'] = Hash::make($request->password);
                $input['role'] = 2;
                $input['is_active'] = $is_active;
                $input['is_verified'] = $is_verified;

                if (!empty($request->photo_profile)){
                    if ($request->file('photo_profile')) {
                        $path_photo_profile_name = Str::lower( 'user-' . strtotime("now") . '.' . $request->photo_profile->extension());
                        $path_photo_profile = $request->file('photo_profile')->storeAs('users', $path_photo_profile_name, 'public');
                        $input['photo_profile'] = '/storage/' . $path_photo_profile;
                    }
                }

                User::create($input);
                return response()->json(['status' => 'success']);
            });

            return $trans;

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e . ' Something went wrong'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);
        $data = User::find($id);

        if ($data == null) {
            return redirect()->intended('admin/user');
        }

        return view('backend.users.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }

    public function delete_user(Request $request)
    {
        try {
            // Fetch the item to be deleted, e.g., using the $id parameter
            $id = decrypt($request->id);

            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'user not found'], 404);
            }

            // Perform the deletion (or any other business logic)
            $user->delete();

            return response()->json(['message' => 'user deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the item'], 500);
        }
    }
}
