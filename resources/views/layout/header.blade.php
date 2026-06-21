<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>

<body>
    <div class="top-header">

        <div class="logo-section">

            <span class="logo-box">
                >URL<
                    </span>


                    <a style="color:black;" href="#">
                        Dashboard
                    </a>
        </div>

        @auth

        <div class="right-menu">


            <form action="{{ route('logout') }}"
                method="POST"
                style="display:inline">

                @csrf

                <button type="submit"
                    class="logout-btn">
                    Logout →
                </button>

            </form>

        </div>

        @endauth

    </div>
</body>

</html>