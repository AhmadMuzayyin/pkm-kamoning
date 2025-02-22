<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-secondary d-inline-flex align-items-center text-uppercase font-weight-semibold  transition']) }}>
    {{ $slot }}
</button>
