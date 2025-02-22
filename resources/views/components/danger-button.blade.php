<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-danger text-uppercase fw-semibold btn-sm d-inline-flex align-items-center']) }}>
    {{ $slot }}
</button>
