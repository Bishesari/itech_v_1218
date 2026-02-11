<div class="flex flex-col">
    <x-auth-header :title="__('ورود به حساب کاربری')"
                   :description="__('نام کاربری (کدملی) و پسورد قبلا پیامک شده است.')"/>

    <form wire:submit.prevent="login" class="space-y-4 flex flex-col mt-5" autocomplete="off">
        <x-my.flt_lbl name="user_name" label="{{__('نام کاربری:')}}" dir="ltr" maxlength="25"
                      class="tracking-wider font-semibold" autofocus required/>

        <x-my.flt_lbl name="password" type="password" label="{{__('کلمه عبور:')}}" dir="ltr" maxlength="25"
                      class="tracking-wider font-semibold" required/>

        <div class="flex justify-between">
            <!-- Remember Me -->
            <flux:field variant="inline">
                <flux:checkbox wire:model="remember" class="cursor-pointer"/>
                <flux:label class="cursor-pointer">{{__('بخاطرسپاری')}}</flux:label>
            </flux:field>
{{--            <flux:link class="text-sm" :href="route('forgotten.password')" wire:navigate tabindex="-1">--}}
{{--                {{ __('ریست کلمه عبور') }}--}}
{{--            </flux:link>--}}
        </div>

        <div class="flex items-center justify-end">
            <flux:button variant="primary" color="violet" type="submit" class="w-full cursor-pointer"
                         data-test="login-button">
                {{ __('ورود') }}
            </flux:button>
        </div>
    </form>
        <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400 mt-4">
            <span>{{ __('حساب کاربری ندارید؟') }}</span>
            <flux:button :href="route('register')" wire:navigate variant="ghost" icon:trailing="arrow-up-left" size="sm"
                         class="cursor-pointer">{{ __('ثبت نام کنید.') }}
            </flux:button>
        </div>

</div>
