<aside {{ $attributes->
    class('sidebar')->merge(['id'=>'sidebar']) }}>
    <ul {{ $attributes->
        class('sidebar-nav')->merge(['id'=>'sidebar-nav']) }}>
        {{
            $slot
        }}
    </ul>
</aside>
