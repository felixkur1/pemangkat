<ul class="inline-flex -space-x-px text-sm">
@foreach ($options as $index => $option)
  <li>
    <input type="radio" name="{{ $name }}" id="{{ $name }}-{{ $index }}" class="hidden peer" value="{{ $option['value'] }}" onchange="this.form.submit()" {{ $option['value'] == $selectedValue ? 'checked' : '' }}>
    <label for="{{ $name }}-{{ $index }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 {{ $index == 0 ? 'rounded-s-lg' : ($index == count($options) - 1 ? 'rounded-e-lg' : '') }} peer-checked:bg-blue-500 peer-checked:text-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $option['name'] }}</label>
  </li>
@endforeach
</ul>
