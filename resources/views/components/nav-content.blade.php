<ul {{ $attributes->
    class('nav-content collapse')->merge(['data-bs-parent'=>'#sidebar-nav']) }}>
    {{
        $slot
    }}
</ul>
