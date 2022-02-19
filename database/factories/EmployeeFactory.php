<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randJob = Job::get()->random();
        $empID = $this->faker->numerify('EMP-########');

        while(Employee::where('employee_id', $empID)->exists()){
            $empID = $this->faker->numerify('EMP-########');
        }

        $minBasic = $randJob->minimum_basic;
        $maxBasic = $randJob->maximum_basic;

        $qualifications = [
            'SPM',
            'Diploma in Computer Science',
            'Degree in Computer Science',
            'PhD in Computer Science',
            'Diploma in Finance',
            'Degree in Finance',
            'PhD in Finance',
            'Diploma in Multimedia Design',
            'Degree in Multimedia Design',
            'PhD in Multimedia Design',
            'Diploma in Event Management',
            'Degree in Event Management',
            'PhD in Event Management',
            'Diploma in Logistic Management',
            'Degree in Logistic Management',
            'PhD in Logistic Management',
            'Diploma in Business',
            'Degree in Business',
            'PhD in Business',
            'Diploma in Marketing',
            'Degree in Marketing',
            'PhD in Marketing',
        ];

        $qualification = $qualifications[rand(0, 21)-1];

        return [
            'job_id' => $randJob->id,
            'employee_id' => $empID,
            'name' => $this->faker->lastName().' '.$this->faker->firstName(),
            'date_joined' => $this->faker->date(),
            'qualification' => $qualification,
            'work_type' => rand(0,1) == 1 ? 'Full-Time' : 'Part-Time',
            'basic_salary' => $this->faker->randomFloat(2, $minBasic, $maxBasic),
            'contact_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'birth_date' => $this->faker->date()
        ];
    }
}
