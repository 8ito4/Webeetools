                    <x-nav-link :href="route('tools.pomodoro')" :active="request()->routeIs('tools.pomodoro')">
                        {{ __('Pomodoro Timer') }}
                    </x-nav-link>
                    <x-nav-link :href="route('tools.api-tester')" :active="request()->routeIs('tools.api-tester')">
                        {{ __('API Tester') }}
                    </x-nav-link> 