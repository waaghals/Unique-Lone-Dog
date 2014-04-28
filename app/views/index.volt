<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ title }}</title>
        {{ partial("partials/meta") }}
        {{ partial("partials/icons") }}

        {{ stylesheet_link("css/kraken.css") }}
        {{ stylesheet_link("css/astro.css") }}
        {{ javascript_include("js/feature-test.js") }}
    </head>

    <body>

        <section class="container">
            {{ partial("partials/nav") }}

            {{ content() }}

        </section>
        <script>
            astro.init();
        </script>

        {{ javascript_include("js/kraken.js") }}
        {{ javascript_include("js/astro.js") }}
        {{ javascript_include("js/buoy.js") }}
        {{ partial("partials/analytics") }}
    </body>
</html>
