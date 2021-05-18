<nav id="sidebar">
    <div class="sidebar-header">
        <img src="{{ url('/')}}/images/logo.svg" alt="" style="width: 50%;">
    </div>
    <div id="accordion" class="accordion accordion-custom">
        <div class="mb-0">
            <div class="text-center">
                <select name="language" id="language" onchange="setLanguage(this.value);" class="mb-2">
                    <option value="en" {{ session('locale')=='en'?'selected':'' }}>
                        {{ __('sidebar.English') }}
                    </option>
                    <option value="hi" {{ session('locale')=='hi'?'selected':'' }}>
                        {{ __('sidebar.Hindi') }}
                    </option>
                </select>
            </div>
            <ul class="list-unstyled sidelist components">
                <li class="{{ request()->is('/')?'active':''}}">
                    <a href="{{route('welcome')}}" aria-expanded="false">
                        <i class="mr-2 fa fa-home">
                            <!-- <img src="{{ url('/')}}/images/logo.svg" alt=""> -->
                        </i>
                        {{ __('sidebar.Home') }}
                    </a>
                </li>

                @auth()

                @if(auth()->user()->role->name == 'Admin')
                <li class="{{ request()->is('products/trash')?'active':''}}">
                    <a href="{{route('products.trash')}}" aria-expanded="false">
                        <i class="mr-2 fa fa-trash"></i>
                        {{ __('sidebar.Trash') }}
                    </a>
                </li>
                @endif

                @if(auth()->user()->role->name == 'Vendor' or auth()->user()->role->name == 'Admin')
                <li class="{{ request()->is('product/create')?'active':''}}{{ request()->is('product')?'active':''}}">
                    <a data-toggle="collapse" class="tooglenav" data-parent="#accordion" href="#collapseThree">
                        <i class="mr-2 fa fa-shopping-bag"></i>
                        {{ __('sidebar.Products') }}
                    </a>
                    <ul class="collapse show list-unstyled listblock" data-parent="#accordion" id="collapseThree">
                        <li>
                            <a href="{{route('products.index')}}" class="{{ request()->is('product')?'active':''}}">{{ __('sidebar.List') }}</a>
                        </li>
                        <li>
                            <a href="{{route('products.create')}}" class="{{ request()->is('product/create')?'active':''}}">{{ __('sidebar.Add Product') }}</a>
                        </li>
                    </ul>
                </li>
                @endif

                @endauth
            </ul>
        </div>
    </div>
    <div class="footer">
        <div class="footerlogo">
            <img src="{{ url('/')}}/images/logo.svg" alt="" style="width: 20%;">
            <span>
                {{ __('sidebar.Powered by: globalgarner') }}
            </span>
        </div>
        <div class="contactbg">
            <div class="mob-icon">
                <img src="./images/mob-icon.png" alt="">
            </div>
            <div class="smalltext">
                <div class="question">
                    {{ __('sidebar.Questions') }}
                    ?
                </div>
                <div class="contact">
                    {{ __('sidebar.Contact Us') }}
                </div>
            </div>
        </div>
    </div>
</nav>