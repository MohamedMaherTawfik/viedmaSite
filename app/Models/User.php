<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function applyTeacher()
    {
        return $this->hasOne(applyTeacher::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the graduation projects associated with the user.
     */
    public function graduationProjects()
    {
        return $this->hasMany(graduationProject::class, 'teacher_id');
    }

    public function review()
    {
        return $this->hasMany(Reviews::class);
    }

    public function quiz()
    {
        return $this->hasMany(quizes::class);
    }

    public function result()
    {
        return $this->hasMany(Result::class);
    }

    public function course()
    {
        return $this->hasMany(Courses::class);
    }
    public function Enrolledcourse()
    {
        return $this->belongsToMany(Courses::class, 'enrollments', 'user_id', 'courses_id')
            ->withPivot(['price', 'transaction_type'])
            ->withTimestamps();
    }

    public function school()
    {
        return $this->belongsTo(school::class, 'school_id');
    }

    public function student()
    {
        return $this->hasMany(student::class);
    }

    public function report()
    {
        return $this->hasMany(report::class, 'user_id');
    }

    public function reported()
    {
        return $this->belongsTo(report::class, 'student_id');
    }

    public function graduationNotes()
    {
        return $this->hasMany(graduationNotes::class, 'user_id');
    }

    public function sessionTimes()
    {
        return $this->hasMany(sessionTime::class);
    }

    public function uploadedFileTeacher()
    {
        return $this->hasMany(graduationNotes::class, 'uploaded_teacher_id');
    }

    public function cart()
    {
        return $this->hasOne(cart::class);
    }

    public function order()
    {
        return $this->hasMany(orders::class);
    }

    public function certificates()
    {
        return $this->hasMany(certificate::class);
    }
}
