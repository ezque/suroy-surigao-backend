<template>
    <div class="login-container">
        <div class="login-card">
            <!-- LEFT -->
            <div class="card-left">
                <div class="form-logo">
                    <img src="/public/images/auth-logo.png" alt="logo" />
                </div>

                <!-- LOGIN FORM -->
                <div class="login-form-con" v-if="activeForm === 'login'">
                    <h2>login</h2>
                    <label>Email</label>
                    <input
                        placeholder="Email"
                        type="email"
                        v-model="loginForm.email"
                        required
                    />
                    <span v-if="errors.email" class="error">{{ errors.email[0] }}</span>

                    <label>Password</label>
                    <input
                        placeholder="Password"
                        type="password"
                        v-model="loginForm.password"
                        required
                    />
                    <span v-if="errors.password" class="error">{{ errors.password[0] }}</span>

                    <a>Forgot Password</a>
                    <button @click="handleLogin" :disabled="loading">Sign in</button>
                    <p>
                        Don't Have an Account yet?
                        <a @click="activeForm = 'register'">register</a>
                    </p>
                </div>

                <!-- REGISTER FORM -->
                <div class="register-form-con" v-else>
                    <h2>register</h2>

                    <label>Email</label>
                    <input placeholder="Email" type="email" v-model="registerForm.email" />
                    <span v-if="errors.email" class="error">{{ errors.email[0] }}</span>

                    <label>Password</label>
                    <input
                        placeholder="Password"
                        type="password"
                        v-model="registerForm.password"
                    />
                    <span v-if="errors.password" class="error">{{ errors.password[0] }}</span>

                    <label>Personal Information</label>
                    <div class="register-group">
                        <input placeholder="First Name" v-model="registerForm.firstName" />
                        <input placeholder="Last Name" v-model="registerForm.lastName" />
                    </div>
                    <span v-if="errors.firstName" class="error">{{ errors.firstName[0] }}</span>
                    <span v-if="errors.lastName" class="error">{{ errors.lastName[0] }}</span>

                    <div class="register-group">
                        <input
                            placeholder="Phone Number"
                            v-model="registerForm.phone_num"
                            type="tel"
                        />
                        <select v-model="registerForm.gender">
                            <option disabled value="">Select Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                    <span v-if="errors.phone_num" class="error">{{ errors.phone_num[0] }}</span>
                    <span v-if="errors.gender" class="error">{{ errors.gender[0] }}</span>

                    <button @click="handleRegister" :disabled="loading">Register</button>
                    <p>
                        Already Have an Account?
                        <a @click="activeForm = 'login'">Login Here</a>
                    </p>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="card-right">
                <img src="/public/images/logo/logo.png" alt="logo" />
                <h2>welcome!</h2>
                <h3>your journey starts here</h3>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
    import { ref, reactive } from "vue";
    import axios from "axios";

    const activeForm = ref<"login" | "register">("login");
    const loading = ref(false);
    const errors = reactive<Record<string, string[]>>({});

    // LOGIN
    const loginForm = reactive({
        email: "",
        password: "",
    });

    const handleLogin = async () => {
        loading.value = true;
        Object.keys(errors).forEach((key) => (errors[key] = []));

        try {
            const response = await axios.post("/login", loginForm, {
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content"),
                },
            });

            if (response.data.redirect) {
                window.location.href = response.data.redirect;
            }
        } catch (error: any) {
            if (error.response?.status === 422) {
                Object.assign(errors, error.response.data.errors);
            } else {
                console.error("Unexpected login error:", error);
            }
        } finally {
            loading.value = false;
        }
    };

    // REGISTER
    const registerForm = reactive({
        email: "",
        password: "",
        firstName: "",
        lastName: "",
        phone_num: "",
        gender: "",
    });


    const handleRegister = async () => {
        loading.value = true;
        Object.keys(errors).forEach((key) => (errors[key] = []));

        try {
            const response = await axios.post("/register", registerForm, {
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content"),
                },
            });

            if (response.data.redirect) {
                window.location.href = response.data.redirect;
            } else {
                activeForm.value = "login"; // go to login after register
            }
        } catch (error: any) {
            if (error.response?.status === 422) {
                Object.assign(errors, error.response.data.errors);
            } else {
                console.error("Unexpected register error:", error);
            }
        } finally {
            loading.value = false;
        }
    };
</script>

<style scoped>
    .login-container {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url("/images/ilovesurigao.jpg") no-repeat center center/cover;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        padding: 20px;
    }

    /* Card Wrapper */
    .login-card {
        width: 100%;
        max-width: 950px;
        display: flex;
        flex-direction: row;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 8px 35px rgba(0, 0, 0, 0.25);
        animation: fadeIn 0.6s ease;
        border: 6px solid #A6D7EE;
    }

    /* Right Panel */
    .card-right {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: white;
        text-align: center;
        padding: 40px 20px;
    }

    .card-right img {
        width: 160px;
        margin-bottom: 20px;
    }

    .card-right h2 {
        margin: 0;
        font-size: 2.4em;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .card-right h3 {
        margin-top: 12px;
        font-size: 1.1em;
        padding: 8px 20px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 25px;
        font-weight: 500;
    }

    /* Left Panel */
    .card-left {
        flex: 1;
        background-color: #A6D7EE;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 30px 25px;
    }

    .form-logo {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
    .form-logo img {
        width: 200px;
        height: auto;
    }

    /* Form Containers */
    .login-form-con,
    .register-form-con {
        width: 100%;
        max-width: 340px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .login-form-con h2,
    .register-form-con h2 {
        font-size: 1.8em;
        font-weight: 600;
        margin-bottom: 8px;
        color: #007a8c;
        text-align: center;
        text-transform: uppercase;
    }

    label {
        font-size: 0.95em;
        font-weight: 500;
        color: #333;
    }

    input,
    select {
        width: 100%;
        padding: 12px 14px;
        border-radius: 12px;
        border: 1px solid #ccc;
        background: #fff;
        font-size: 0.95em;
        transition: all 0.3s ease;
    }
    input:focus,
    select:focus {
        border-color: #007a8c;
        box-shadow: 0 0 8px rgba(0, 122, 140, 0.3);
        outline: none;
    }

    /* Links */
    .login-form-con a {
        text-align: right;
        font-size: 0.9em;
        color: #f24822;
        cursor: pointer;
        transition: color 0.2s;
    }
    .login-form-con a:hover {
        color: #c93018;
    }

    /* Buttons */
    button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 25px;
        background: #007a8c;
        color: white;
        font-weight: bold;
        font-size: 1em;
        cursor: pointer;
        margin-top: 6px;
        transition: background 0.3s, transform 0.2s;
    }
    button:hover {
        background: #005f6b;
        transform: translateY(-2px);
    }
    button:disabled {
        background: #a5cfd6;
        cursor: not-allowed;
    }

    /* Register groups */
    .register-group {
        display: flex;
        gap: 12px;
    }
    .register-group input,
    .register-group select {
        flex: 1;
    }

    /* Bottom text */
    .login-form-con p,
    .register-form-con p {
        text-align: center;
        margin-top: 6px;
        font-size: 0.95em;
        color: #333;
    }
    .login-form-con p a,
    .register-form-con p a {
        font-weight: bold;
        color: #007a8c;
        cursor: pointer;
        transition: color 0.2s;
    }
    .login-form-con p a:hover,
    .register-form-con p a:hover {
        color: #005f6b;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 900px) {
        .login-card {
            flex-direction: column;
            max-width: 500px;
        }
        .card-left,
        .card-right {
            flex: unset;
            width: 100%;
        }
        .card-right {
            padding: 30px 20px;
        }
    }
    .error {
        font-size: 0.85em;
        color: #d93025;
        margin-top: -8px;
        margin-bottom: 4px;
    }
</style>
