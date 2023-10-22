{{-- <div class="hidden-scroll-bar overflow-auto h-100">
    <a class="d-flex mb-3 menu-parent @if (isCurrentRouteInRoutes('frontend.user.dashboard')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
       href="{{ route('frontend.user.dashboard') }}">
        <div class="d-flex align-items-center">
            <img class="sidebar-route-svg" src="{{ asset('icons/dashboard/GridFill.svg') }}">
            <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Dashboard')</div>
        </div>
    </a>
    <div class="pl-4 @if (!isCurrentRouteInRoutes('frontend.user.dashboard') && !isCurrentRouteInRoutes('frontend.dashboard.*')) d-none @endif">
        <a class="d-flex mb-3 @if (isCurrentRouteInRoutes('frontend.dashboard.schools.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
           href="{{route('frontend.dashboard.schools.index')}}">
            <div class="d-flex align-items-center ml-3">
                <div class="text-sky-700 fw-bold fs-5 ml-4">@lang('Progress')</div>
            </div>
        </a>
        <a class="d-flex mb-3 sidebar-route-normal text-lg"
           href="#">
            <div class="d-flex align-items-center ml-3">
                <div class="text-sky-700 fw-bold fs-5 ml-4">@lang('Achievement')</div>
            </div>
        </a>
        <a class="d-flex mb-3 sidebar-route-normal text-lg"
           href="#">
            <div class="d-flex align-items-center ml-3">
                <div class="text-sky-700 fw-bold fs-5 ml-4">@lang('Ranking')</div>
            </div>
        </a>
    </div>
    @canany(['user.school', 'user.school.view'])
        <a class="d-flex mb-3 @if (isCurrentRouteInRoutes('frontend.schools.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
           href="{{route('frontend.schools.index')}}">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-landmark fa-lg sidebar-icon"></i>
                <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('School management')</div>
            </div>
        </a>
    @endcanany
    @canany(['user.class', 'user.class.view'])
        <a class="d-flex mb-3 @if (isCurrentRouteInRoutes('frontend.classes.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
           href="{{ route('frontend.classes.index') }}">
            <div class="d-flex align-items-center">
                <i class="fa-regular fa-building fa-lg sidebar-icon"></i>
                <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Class management')</div>
            </div>
        </a>
    @endcanany
    @canany(['user.management', 'user.management.assistant'])
        <a class="d-flex mb-3 @if (isCurrentRouteInRoutes('frontend.assistants.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
           href="{{ route('frontend.assistants.index') }}">
            <div class="d-flex align-items-center">
                <i class="fas fa-chalkboard-teacher fa-lg sidebar-icon"></i>
                <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Assistant management')</div>
            </div>
        </a>
    @endcanany
    @canany(['user.management', 'user.management.instructor'])
        <a class="d-flex mb-3 @if (isCurrentRouteInRoutes('frontend.instructors.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
           href="{{route('frontend.instructors.index')}}">
            <div class="d-flex align-items-center">
                <i class="fa-regular fa-user fa-lg sidebar-icon"></i>
                <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Instructor management')</div>
            </div>
        </a>
    @endcanany
    @canany(['user.management', 'user.management.student'])
        <a class="d-flex mb-3 @if (isCurrentRouteInRoutes('frontend.students.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
           href="{{route('frontend.students.index')}}">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-street-view fa-lg sidebar-icon"></i>
                <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Student management')</div>
            </div>
        </a>
    @endcanany
    @canany(['user.course.overall', 'user.course.course', 'user.course.lesson', 'user.course.learning-resource'])
        <a class="d-flex mb-3 sidebar-route-normal text-lg menu-parent" data-toggle="collapse" role="button"
           href="#course-management-items">
            <div class="d-flex align-items-center">
                <i class="fa-regular fa-folder-closed fa-lg sidebar-icon"></i>
                <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Course management')</div>
                <i class="ml-2 fa fa-angle-down " aria-hidden="true"></i>
            </div>
        </a>
        <div id="course-management-items" class="sidebar-items-collapse collapse pl-4
            @if (isCurrentRouteInRoutes('frontend.courses.*') || isCurrentRouteInRoutes('frontend.lessons.*') || isCurrentRouteInRoutes('frontend.activities.*')) show @endif">
            @canany(['user.course.overall', 'user.course.course'])
                <a class="d-flex mb-3 @if (isCurrentRouteInRoutes('frontend.courses.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
                   href="{{ route('frontend.courses.index') }}">
                    <div class="d-flex align-items-center">
                        <i class="far fa-folder fa-lg sidebar-icon"></i>
                        <div class="text-sky-700 fw-bold fs-5 pl-3">@lang('Course management')</div>
                    </div>
                </a>
            @endcanany
            @canany(['user.course.overall', 'user.course.lesson'])
                <a class="d-flex mb-3 text-lg
                    @if (isCurrentRouteInRoutes('frontend.lessons.*'))
                        sidebar-route-selected @else sidebar-route-normal @endif
                    " href="{{route('frontend.lessons.index')}}">
                    <div class="d-flex align-items-center">
                        <i class="fa-regular fa-newspaper fa-lg sidebar-icon"></i>
                        <div class="text-sky-700 fw-bold fs-5 pl-3">@lang('Lesson management')</div>
                    </div>
                </a>
            @endcanany
            @canany(['user.course.overall', 'user.course.learning-resource'])
                <a class="d-flex mb-3 text-lg
                    @if (isCurrentRouteInRoutes('frontend.activities.*')) sidebar-route-selected @else sidebar-route-normal @endif
                    " href="{{route('frontend.activities.index')}}">
                    <div class="d-flex align-items-center">
                        <i class="far fa-file-alt fa-lg sidebar-icon"></i>
                        <div class="text-sky-700 fw-bold fs-5 pl-3">@lang('Learning resources')</div>
                    </div>
                </a>
            @endcanany
        </div>
    @endcanany
    @canany(['user.quiz.overall', 'user.quiz.quiz', 'user.quiz.question-bank', 'user.quiz.do-quiz', 'user.quiz.grade-quiz'])
        <a class="d-flex mb-3 sidebar-route-normal menu-parent " data-toggle="collapse" role="button"
           href="#quiz-management-items">
            <div class="d-flex align-items-center">
                <i class="fas fa-tasks fa-lg sidebar-icon"></i>
                <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Test management')</div>
                <i class="ml-2 fa fa-angle-down" aria-hidden="true"></i>
            </div>
        </a>
        <div id="quiz-management-items"
             class="sidebar-items-collapse collapse pl-4 @if (isCurrentRouteInRoutes('frontend.tests.*') || isCurrentRouteInRoutes('frontend.questions.*')) show @endif">
            @canany(['user.quiz.overall', 'user.quiz.quiz'])
                <a class="d-flex mb-3 sidebar-route-normal text-lg @if (isCurrentRouteInRoutes('frontend.tests.*')) sidebar-route-selected @else sidebar-route-normal @endif"
                   href="{{ route('frontend.tests.index') }}">
                    <div class="d-flex align-items-center">
                        <i class="fa-regular fa-lightbulb fa-lg sidebar-icon"></i>
                        <div class="text-sky-700 fw-bold fs-5 pl-3">@lang('Test management')</div>
                    </div>
                </a>
            @endcanany
            @canany(['user.quiz.overall', 'user.quiz.question-bank'])
                <a class="d-flex mb-3 sidebar-route-normal text-lg @if (isCurrentRouteInRoutes('frontend.questions.*')) sidebar-route-selected @else sidebar-route-normal @endif"
                   href="{{ route('frontend.questions.index') }}">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-question fa-lg sidebar-icon"></i>
                        <div class="text-sky-700 fw-bold fs-5 pl-3 flex-grow-1">@lang('Question bank')</div>
                    </div>
                </a>
            @endcanany
        </div>
    @endcanany
    @canany(['user.role-permission.management'])
        <a class="d-flex mb-3 @if (isCurrentRouteInRoutes('frontend.roles.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
           href="{{route('frontend.roles.index')}}">
            <div class="d-flex align-items-center">
                <img class="sidebar-route-svg" src="{{ asset('icons/dashboard/Gear.svg') }}">
                <div class="text-sky-700 fw-bold fs-5 ml-3 flex-grow-1">@lang('Settings')</div>
            </div>
        </a>
    @endcanany
    <a class="d-flex mb-3 sidebar-route-normal" href="#"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-arrow-right-from-bracket fa-lg sidebar-icon"></i>
            <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Logout')</div>
        </div>
    </a>
</div> --}}

<a class="d-flex mb-3 @if (isCurrentRouteInRoutes('frontend.categories.*')) sidebar-route-selected @else sidebar-route-normal @endif text-lg"
    href="{{ route('frontend.categories.index') }}">
    <div class="d-flex align-items-center">
        <i class="fa-solid fas fa-store fa-lg sidebar-icon"></i>
        <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Category')</div>
    </div>
</a>
<a class="d-flex mb-3 sidebar-route-normal text-lg menu-parent" data-toggle="collapse" role="button"
    href="#course-management-items">
    <div class="d-flex align-items-center">
        <i class="fa-solid fas fa-store fa-lg sidebar-icon"></i>
        <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Product Management')</div>
        <i class="ml-2 fa fa-angle-down " aria-hidden="true"></i>
    </div>
</a>
<div id="course-management-items" class="sidebar-items-collapse collapse pl-4">
    <a class="d-flex mb-3 sidebar-route-normal  text-lg" href="{{ route('frontend.products.index') }}">
        <div class="d-flex align-items-center">
            <i class="far fa-folder fa-lg sidebar-icon"></i>
            <div class="text-sky-700 fw-bold fs-5 pl-3">@lang('All Products')</div>
        </div>
    </a>
    <a class="d-flex mb-3 text-lg sidebar-route-normal
            " href="">
        <div class="d-flex align-items-center">
            <i class="fa-regular fa-newspaper fa-lg sidebar-icon"></i>
            <div class="text-sky-700 fw-bold fs-5 pl-3">@lang('Lesson management')</div>
        </div>
    </a>
</div>
<a class="d-flex mb-3 sidebar-route-normal text-lg" href="{{ route('frontend.categories.index') }}">
    <div class="d-flex align-items-center">
        <i class="fa-solid fas fa-store fa-lg sidebar-icon"></i>
        <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Product')</div>
    </div>
</a>
<a class="d-flex mb-3 sidebar-route-normal text-lg" href="{{ route('frontend.categories.index') }}">
    <div class="d-flex align-items-center">
        <i class="fa-solid fas fa-store fa-lg sidebar-icon"></i>
        <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Product')</div>
    </div>
</a>
<a class="d-flex mb-3 sidebar-route-normal text-lg" href="{{ route('frontend.categories.index') }}">
    <div class="d-flex align-items-center">
        <i class="fa-solid fas fa-store fa-lg sidebar-icon"></i>
        <div class="text-sky-700 fw-bold fs-5 ml-3">@lang('Product')</div>
    </div>
</a>
