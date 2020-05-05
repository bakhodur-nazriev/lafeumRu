export default {
    required(v) {
        if (Array.isArray(v) && v.length == 0) {
            return "Обязательное поле";
        }

        if (!v) {
            return "Обязательное поле";
        }

        return true;
    },
    email(value) {
        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return pattern.test(value) || "Неправильный email";
    },
    getMin(min) {
        return value => (value && value.length >= min) || `Минимум ${min} символов`;
    },
    getPasswordConfirm(password) {
        return value =>
            value === password || "Пароли не совпадают";
    }
};
