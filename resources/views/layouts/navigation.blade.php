<aside 
    class="fixed inset-y-0 left-0 z-50 flex-shrink-0 w-64 overflow-y-auto bg-white border-r border-slate-200 transform transition-transform duration-300 ease-in-out lg:translate-x-0"
    :class="{'-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen}"
    x-data="sidebarNav()" 
    x-init="initMenu()"
    x-cloak>

    <div class="flex items-center justify-center p-4 border-b border-slate-200 h-[65px]">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-auto">
        </a>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-1">
        <a href="{{ route('dashboard') }}" :class="navLinkClass('dashboard')" class="flex items-center px-3 py-2.5 rounded-lg font-medium">
            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
            Dashboard
        </a>
        
        @php
            $navItems = [
                'order' => ['label' => 'Order Management', 'icon' => '<svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg>', 'children' => [
                    ['route' => 'order.summary', 'label' => 'Summary'],
                    ['route' => 'order.list', 'label' => 'Order List'],
                ]],
                'reports' => ['label' => 'Reports & Analytics', 'icon' => '<svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>', 'children' => [
                    ['route' => '#', 'label' => 'Report'],
                ]],
            ];

            function renderNav($items, $level = 1) {
                $ulClass = 'space-y-1';
                $marginLeft = 'ml-5';
                if ($level > 1) {
                    $ulClass .= ' pt-1 pl-4 border-l border-slate-200 ' . $marginLeft;
                }

                echo "<ul class='{$ulClass}'>";
                foreach ($items as $key => $item) {
                    if (isset($item['children'])) {
                        // It's a dropdown menu
                        $parentKey = is_string($key) ? $key : \Illuminate\Support\Str::camel($item['label']);
                        echo "<li>";
                        echo "<button @click=\"toggleMenu('{$parentKey}')\" :class=\"navButtonClass('{$parentKey}')\" class=\"flex items-center justify-between w-full px-3 py-2.5 text-left rounded-lg font-medium\">";
                        echo "<span class='flex items-center'>";
                        if (isset($item['icon'])) echo $item['icon'];
                        echo $item['label'];
                        echo "</span>";
                        echo "<svg :class=\"{'rotate-90': openMenu.{$parentKey}}\" class='w-4 h-4 transform transition-transform duration-200' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 5l7 7-7 7' /></svg>";
                        echo "</button>";
                        echo "<div x-show=\"openMenu.{$parentKey}\" x-collapse>";
                        renderNav($item['children'], $level + 1);
                        echo "</div>";
                        echo "</li>";
                    } else {
                        // It's a direct link. Check if route is '#' or an actual route.
                        $href = $item['route'] === '#' ? '#' : route($item['route']);
                        $routeClassCheck = $item['route'] === '#' ? 'false' : "'{$item['route']}'";

                        echo "<li><a href=\"" . $href . "\" :class=\"navLinkClass({$routeClassCheck})\" class=\"group flex items-center w-full px-3 py-2 text-left rounded-lg\">";
                        echo "<span class='w-1.5 h-1.5 mr-3 rounded-full bg-slate-300 group-hover:bg-sky-500 transition-colors' :class=\"{'bg-sky-500': isRouteActive({$routeClassCheck})}\"></span>";
                        echo $item['label'] . "</a></li>";
                    }
                }
                echo "</ul>";
            }
        @endphp

        {!! renderNav($navItems) !!}

        @auth
            @if(auth()->user()->role === 'admin')
            <div class="pt-4 mt-4 border-t border-slate-200">
                <p class="px-3 text-xs font-semibold tracking-wider text-slate-400 uppercase">Admin</p>
                <a href="{{ route('admin.users.index') }}" :class="navLinkClass('admin.users.index')" class="flex items-center px-3 py-2.5 mt-2 rounded-lg font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" /></svg>
                    User Settings
                </a>
            </div>
            @endif
        @endauth
    </nav>
</aside>

<script>
    function sidebarNav() {
        return {
            openMenu: {},
            routeName: '{{ request()->route()->getName() }}',
            menuMap: {
                'order.summary': ['order'], 'order.list': ['order'], 
                // Add mappings for new report routes if you create them
                // 'reports.financial.summary': ['reports'], 
                // 'reports.project.client': ['reports'], 
                // 'reports.target.achievement': ['reports'],
            },
            initMenu() {
                const parents = this.menuMap[this.routeName];
                if (parents) {
                    parents.forEach(key => this.openMenu[key] = true);
                }
            },
            toggleMenu(menu) {
                this.openMenu[menu] = !this.openMenu[menu];
            },
            isRouteActive(name) {
                if (name === false) return false;
                return this.routeName === name;
            },
            isParentActive(menuKey) {
                for (const route in this.menuMap) {
                    if (this.menuMap[route].includes(menuKey) && route === this.routeName) {
                        return true;
                    }
                }
                return false;
            },
            navLinkClass(routeName) {
                return this.isRouteActive(routeName)
                    ? 'bg-sky-100 text-sky-600'
                    : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900';
            },
            navButtonClass(menuKey) {
                return this.isParentActive(menuKey)
                    ? 'text-sky-600'
                    : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900';
            }
        }
    }
</script>