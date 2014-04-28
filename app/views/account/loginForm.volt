{{ content() }}
{{ form() }}
<div class="row">
    <div class="grid-fourth">
        {{ form.label('email') }}
    </div>
    <div class="grid-three-fourths">
        {{ form.render('email') }}
    </div>
</div>
<div class="row">
    <div class="grid-fourth">
        {{ form.label('password') }}
    </div>
    <div class="grid-three-fourths">

        {{ form.render('password') }}
    </div>
</div>
<div class="row">
    <div class="grid-fourth">
        {{ form.render('remember') }}
        {{ form.label('remember') }}
    </div>
</div>
<div class="row">
    <div class="grid-three-fourths offset-fourth">
        {{ form.render('go') }}
    </div>
</div>
{{ form.render('csrf', ['value': security.getToken()]) }}
{{ link_to("account/forgotPassword", "Forgot my password") }}
{{ end_form() }}
