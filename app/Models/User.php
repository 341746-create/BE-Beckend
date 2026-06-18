<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public static function sp_GetAllUserroles()
    {
        if (config('database.default') === 'mysql') {
            return self::hydrate(array_map(fn($row) => (array) $row, DB::select('CALL SP_GetAllUserroles()')));
        }

        return self::all();
    }

    public static function sp_GetUserById(int $id): ?self
    {
        if (config('database.default') === 'mysql') {
            $record = DB::selectOne('CALL Sp_GetUserById(?)', [$id]);
            return $record ? new self((array) $record) : null;
        }

        return self::find($id);
    }

    public static function sp_UpdateUser(int $id, string $role): bool
    {
        if (config('database.default') === 'mysql') {
            return DB::statement('CALL SP_UpdateUser(?, ?)', [$id, $role]);
        }

        $user = self::findOrFail($id);
        $user->role = $role;
        return $user->save();
    }

    public static function sp_DeleteUser(int $id): bool
    {
        if (config('database.default') === 'mysql') {
            return DB::statement('CALL Sp_DeleteUser(?)', [$id]);
        }

        return self::where('id', $id)->delete() > 0;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
