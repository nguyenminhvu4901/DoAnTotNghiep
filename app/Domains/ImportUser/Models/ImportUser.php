<?php

namespace App\Domains\ImportUser\Models;

use App\Domains\Staff\Services\StaffService;
use App\Exceptions\GeneralException;
use App\Rules\PasswordRule;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class ImportUser implements ToCollection, SkipsEmptyRows, WithHeadingRow, WithValidation
{
    use Importable;
    /**
     * @param Collection $rows
     * @return void
     * @throws GeneralException
     * @throws \Throwable
     */
    public function collection(Collection $rows): void
    {
        $this->error = [];
        foreach ($rows as $index => $row) {
            $dataImport = resolve(StaffService::class)->importStaff([
                'email' => $row['email'],
                'password' => $row['password'] ?? Hash::make(config('constants.password-default')),
                'name' => $row['name'],
                'gender' => $row['gender'],
                'birthday' => $row['birthday'],
                'phone' => $row['phone'],
                'bio' => $row['bio']
            ]);
            if (gettype($dataImport) === 'string') {
                $this->error[] = $dataImport;
            }
        }
    }

    public function getListDataError()
    {
        return $this->error;
    }

    /**
     * @param $row
     * @return array
     */
    public function prepareForValidation($row): array
    {
        abort_if(!array_key_exists('birthday', $row), Response::HTTP_NOT_ACCEPTABLE);
        $row['birthday'] = is_numeric($row['birthday']) ?
            Date::excelToDateTimeObject($row['birthday'])->format('Y-m-d') : $row['birthday'];
        $row['gender'] = $this->checkGender(Str::lower(regexVnCharacter(trim($row['gender']))));
        $row['email'] = preg_replace('/\s+/', '', $row['email']);
        $row['phone'] = preg_replace('/\s+/', '', $row['phone']);

        return $row;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            '*.email' => [
                'email',
                'required',
                'max:255',
            ],
            '*.name' => ['required', 'min:2', 'max:255'],
            '*.gender' => 'required',
            '*.birthday' => 'required|before:today|date_format:Y-m-d',
            '*.phone' => 'required|regex:/^(\+\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/u',
            '*.password' => ['nullable', 'min:8', 'max:16', new PasswordRule()],
        ];
    }

    /**
     * @param $gender
     * @return int
     */
    public function checkGender($gender): int
    {
        switch ($gender) {
            case "nam":
            case "male":
                return 0;
            case "nu":
            case "female":
                return 1;
            case "khac":
            case "other":
            default:
                return 2;
        }
    }
}
