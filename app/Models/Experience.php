protected function casts(): array
{
return [
'start_date' => 'date',
'end_date' => 'date',
'is_current' => 'boolean',
'sort_order' => 'integer',
'is_visible' => 'boolean',
];
}

public function localized(string $field): ?string
{
$locale = app()->getLocale();

return $this->{$field . '_' . $locale}
?? $this->{$field . '_en'}
?? $this->{$field . '_ar'};
}
