{{ form() }}
{% for element in form %}
<div class="row">
    <div class="grid-fourth">
        {{ element.label() }}
    </div>
    <div class="grid-three-fourths">
        {{ element.render() }}
    </div>
</div>
{% endfor %}
{{ end_form() }}
