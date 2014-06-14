<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Title</title>
        {{ partial("partials/meta") }}
        {{ partial("partials/icons") }}
        {{ stylesheet_link("css/kraken.css") }}
        {{ stylesheet_link("css/astro.css") }}
        {{ assets.outputCss() }}
        {{ javascript_include("js/feature-test.js") }}
    </head>

    <body>

        <section class="container">
            {{ partial("partials/nav") }}

            {{ flashSession.output() }}

            {{ content() }}

        </section>
        {{ javascript_include("js/astro.js") }}
        {{ javascript_include("js/buoy.js") }}
        {{ assets.outputJs() }}
        <script>
            astro.init();
        </script>
        {{ partial("partials/analytics") }}
    </body>
</html>
