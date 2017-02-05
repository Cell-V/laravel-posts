@php
$columnSizes = [
  'sm' => [4, 8],
  'lg' => [2, 10]
];
@endphp

{!! BootForm::openHorizontal($columnSizes)->action(route('post.store')) !!}
{!! BootForm::text('Field Label', 'field_name')->hideLabel() !!}
{!! BootForm::close() !!}
