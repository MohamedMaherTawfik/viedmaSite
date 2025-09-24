<?php

namespace App\Http\Controllers\adminstrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class settingsController extends Controller
{
    public function settings()
    {
        return view('admin.settings.index');
    }

    public function updateUser(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'phone' => ['required', 'string', 'max:255'],
        ]);
        if ($request->hasFile('photo')) {
            $fields['photo'] = $request->file('photo')->store('photos', 'public');
        }
        $user = User::where('id', Auth::id())->update($fields);
        if (!$user) {
            abort(403, 'Unauthorized action.');
        }
        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'تم تغيير كلمة المرور بنجاح.');
    }
}
