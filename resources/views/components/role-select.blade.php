@props(['user' => null])
<div>
    <select {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
        @foreach($roles as $role)
            <option {{ $isSelected($role, $user) ? 'selected' : '' }}
                    value="{{ $role->value }}">{{ $role->name }}</option>
        @endforeach
    </select>
</div>
