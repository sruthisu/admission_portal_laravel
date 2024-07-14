<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('login'); // Adjusted view name here
    }

    /**
     * Handle the login process.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Static credentials
        $staticUsername = 'admin';
        $staticPassword = 'password123';

        if ($request->username === $staticUsername && $request->password === $staticPassword) {
            Session::put('admin', true);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Display the admin dashboard with a listing of the submitted form details.
     */
    public function index()
    {
        if (!Session::has('admin')) {
            return redirect()->route('admin.login');
        }

        $students = Student::all();
        return view('dashboard', compact('students'));
    }

    /**
     * Update the admitted status of a student.
     */
    public function updateAdmittedStatus(Request $request, $id)
    {
        if (!Session::has('admin')) {
            return redirect()->route('admin.login');
        }

        $student = Student::findOrFail($id);
        $student->admitted_status = $request->has('admitted');
        $student->save();

        return redirect()->back()->with('success', 'Admitted status updated successfully.');
    }

    /**
     * Handle logout.
     */
    

    public function logout(Request $request)
{
    Session::forget('admin');
    return redirect()->route('admin.login');
}
}
