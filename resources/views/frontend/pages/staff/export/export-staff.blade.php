<table>
    <thead>
    <tr>
        <th class="text-center">
            @lang('Email')
        </th>
        <th class="text-center">
            @lang('Name')
        </th>
        <th class="text-center">
            @lang('Created Date')
        </th>
        <th class="text-center">
            @lang('Gender')
        </th>
        <th class="text-center">
            @lang('Birthday')
        </th>
        <th class="text-center">
            @lang('Phone')
        </th>
        <th class="text-center">
            @lang('Bio')
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($staff as $eachStaff)
        <tr>
            <td class="text-center align-middle">
                {{ $eachStaff->name }}
            </td>
            <td class="text-center align-middle">
                {{ $eachStaff->email }}
            </td>
            <td class="text-center align-middle">
                {{ $eachStaff->formatted_created_at }}
            </td>
            <td class="text-center align-middle">
                {{ __($eachStaff->genderLabel) }}
            </td>
            <td class="text-center align-middle">
                {{ formatDateYMD($eachStaff->birthday, true) }}
            </td>
            <td class="text-center align-middle">
                {{ $eachStaff->phone }}
            </td>
            <td class="text-center align-middle">
                {!! $eachStaff->bio !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>