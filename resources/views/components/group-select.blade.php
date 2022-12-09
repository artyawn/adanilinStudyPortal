@props(['user' => null])
<div>
   <select {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
     @foreach($groups as $group)
         <option {{ $isSelected($group->id, $user) ? 'selected' : '' }}
                 value="{{ $group->id }}">{{ $group->name }}</option>
       @endforeach
   </select>
</div>
