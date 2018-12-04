@component('mail::message')
# Introduction

Hola {{ $user->name }},

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi hic ipsam itaque iusto quia recusandae. Aliquam, culpa ex incidunt provident sit sunt? Commodi laborum, neque numquam officia quia quos repellendus.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

@component('mail::panel')
    This is the panel content.
@endcomponent

@component('mail::table')
    | Laravel       | Table         | Example  |
    | ------------- |:-------------:| --------:|
    | Col 2 is      | Centered      | $10      |
    | Col 3 is      | Right-Aligned | $20      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
