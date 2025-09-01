<template>
    <div class="login-container">
        <div class="login-card">
            <div class="card-left">
                <div class="form-logo">
                    <img src="/public/images/auth-logo.png" alt="logo" />
                </div>
                <div class="login-form-con" v-if="activeForm === 'login'">
                    <h2>login</h2>
                    <label>Email</label>
                    <input placeholder="Email"/>
                    <label>Password</label>
                    <input placeholder="Password"/>
                    <a>Forgot Password</a>
                    <button>Sign in</button>
                    <p>Don't Have an Account yet? <a  @click="activeForm = 'register'">register</a></p>
                </div>
                <div class="register-form-con" v-else>
                    <a @click="activeForm = 'login'"> login</a>
                </div>


            </div>
            <div class="card-right">
                <img src="/public/images/logo/logo.png" alt="logo" />
                <h2>welcome!</h2>
                <h3>your journey starts here</h3>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
    import { ref } from 'vue';

    const activeForm = ref<'login' | 'register'>('login')
</script>
<style scoped>
    .login-container {
        width: 100%;
        height: 100vh;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url("/images/ilovesurigao.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
    .login-card {
        width: 60%;
        height: 70%;
        border-radius: 60px;
        display: flex;
        flex-direction: row;
        border: 9px solid #A6D7EE;
    }
    .card-right {
        width: 50%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    .card-right img {
        width: 50%;
        height: auto;
        margin: 0;
    }
    .card-right h2 {
        margin: 0;
        color: white;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 2em;
    }
    .card-right h3 {
        color: white;
        padding: 10px 40px 10px 40px;
        background-color: #5DB1DB;
        border-radius: 30px;
        text-transform: capitalize;
    }
    .card-left {
        width: 50%;
        height: 100%;
        border-top-left-radius: 40px;
        border-bottom-left-radius: 40px;
        background-color: #A6D7EE;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .form-logo {
        width: 100%;
        height: 40%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .form-logo img {
        width: 40%;
        height: auto;
    }
    .login-form-con {
        width: 70%;
        height: 60%;
        display: flex;
        flex-direction: column;
    }
    .login-form-con h2 {
        text-transform: capitalize;
        color: #333333;
        font-size: 1.4em;
        margin: 0;
        font-weight: bold;
    }
    .login-form-con label {
        margin-top: 10px;
        color: #333333;
        font-size: 1em;
    }
    .login-form-con input {
        width: 100%;
        background-color: white;
        padding: 10px;
        border-radius: 10px;
        margin-top: 5px;
    }
    .login-form-con a {
        text-align: right;
        font-size: 1.1em;
        color: #F24822;
        margin-top: 10px;
        cursor: pointer;
    }
    .login-form-con button {
        width: 100%;
        padding: 5px;
        background-color: #007A8C;
        border-radius: 20px;
        color: white;
        font-weight: bold;
        margin-top: 10px;
    }
    .login-form-con p {
        text-align: center;
        margin-top: 5px;
        text-transform: capitalize;
    }
    .login-form-con p a {
        cursor: pointer;
    }

</style>






<!--<script setup lang="ts">-->
<!--import AuthenticatedSessionController from '@/actions/App/Http/Controllers/Auth/AuthenticatedSessionController';-->
<!--import InputError from '@/components/InputError.vue';-->
<!--import TextLink from '@/components/TextLink.vue';-->
<!--import { Button } from '@/components/ui/button';-->
<!--import { Checkbox } from '@/components/ui/checkbox';-->
<!--import { Input } from '@/components/ui/input';-->
<!--import { Label } from '@/components/ui/label';-->
<!--import AuthBase from '@/layouts/AuthLayout.vue';-->
<!--import { register } from '@/routes';-->
<!--import { request } from '@/routes/password';-->
<!--import { Form, Head } from '@inertiajs/vue3';-->
<!--import { LoaderCircle } from 'lucide-vue-next';-->

<!--defineProps<{-->
<!--    status?: string;-->
<!--    canResetPassword: boolean;-->
<!--}>();-->
<!--</script>-->

<!--<template>-->
<!--    <AuthBase title="Log in to your account" description="Enter your email and password below to log in">-->
<!--        <Head title="Log in" />-->

<!--        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">-->
<!--            {{ status }}-->
<!--        </div>-->

<!--        <Form-->
<!--            v-bind="AuthenticatedSessionController.store.form()"-->
<!--            :reset-on-success="['password']"-->
<!--            v-slot="{ errors, processing }"-->
<!--            class="flex flex-col gap-6"-->
<!--        >-->
<!--            <div class="grid gap-6">-->
<!--                <div class="grid gap-2">-->
<!--                    <Label for="email">Email address</Label>-->
<!--                    <Input-->
<!--                        id="email"-->
<!--                        type="email"-->
<!--                        name="email"-->
<!--                        required-->
<!--                        autofocus-->
<!--                        :tabindex="1"-->
<!--                        autocomplete="email"-->
<!--                        placeholder="email@example.com"-->
<!--                    />-->
<!--                    <InputError :message="errors.email" />-->
<!--                </div>-->

<!--                <div class="grid gap-2">-->
<!--                    <div class="flex items-center justify-between">-->
<!--                        <Label for="password">Password</Label>-->
<!--                        <TextLink v-if="canResetPassword" :href="request()" class="text-sm" :tabindex="5"> Forgot password? </TextLink>-->
<!--                    </div>-->
<!--                    <Input-->
<!--                        id="password"-->
<!--                        type="password"-->
<!--                        name="password"-->
<!--                        required-->
<!--                        :tabindex="2"-->
<!--                        autocomplete="current-password"-->
<!--                        placeholder="Password"-->
<!--                    />-->
<!--                    <InputError :message="errors.password" />-->
<!--                </div>-->

<!--                <div class="flex items-center justify-between">-->
<!--                    <Label for="remember" class="flex items-center space-x-3">-->
<!--                        <Checkbox id="remember" name="remember" :tabindex="3" />-->
<!--                        <span>Remember me</span>-->
<!--                    </Label>-->
<!--                </div>-->

<!--                <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="processing">-->
<!--                    <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />-->
<!--                    Log in-->
<!--                </Button>-->
<!--            </div>-->

<!--            <div class="text-center text-sm text-muted-foreground">-->
<!--                Don't have an account?-->
<!--                <TextLink :href="register()" :tabindex="5">Sign up</TextLink>-->
<!--            </div>-->
<!--        </Form>-->
<!--    </AuthBase>-->
<!--</template>-->
