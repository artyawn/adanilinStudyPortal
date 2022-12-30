<?php

namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileService
{
    public function saveAvatar(User $user, StoreUserRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $request->file('avatar')
                ->storeAs("avatars/{$user->id}", $user->avatar, 'avatars');
        }
    }

    public function updateAvatar(User $user, UpdateUserRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $request->file('avatar')
                ->storeAs("avatars/{$user->id}", $user->avatar, 'avatars');
        }
    }

    public function showAvatar(User $user)
    {
        $path = "avatars/{$user->id}/" . $user->avatar;
        $resize_path = "avatars/{$user->id}/resize_{$user->avatar}";
        if (Storage::disk('avatars')->missing($path)) {
            $path_show = 'avatars/default.png';

            return Storage::url($path_show);
        }

        if (Storage::disk('avatars')->missing($resize_path)) {
            $avatar = Image::make(Storage::disk('avatars')->path($path));
            $avatar->resize(200, 200);
            $avatar->save(Storage::disk('avatars')->path($resize_path));

            return Storage::url($resize_path);
        }

        return Storage::url($resize_path);
    }

    public static function deleteAvatar(User $user)
    {
        Storage::disk('avatars')->deleteDirectory("avatars/{$user->id}");
    }

    public function exportPdf(User $user)
    {
        $subjects = $user->subjects;
        $pdf = Pdf::loadView('users.pdf', compact('subjects', 'user'));

        return $pdf->download("{$user->fio}.pdf");
    }

    public function getLink(User $user)
    {
        $subjects = $user->subjects;
        $path = "export/{$user->id}/{$user->fio}.pdf";
        $pdf = Pdf::loadView('users.pdf', compact('subjects', 'user'));
        Storage::disk('public')->put($path, $pdf->output());

        return Storage::disk('public')->url($path);
    }
}
