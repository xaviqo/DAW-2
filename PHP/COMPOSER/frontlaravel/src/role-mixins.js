
export const roleMixins = {
    methods: {
        async isAdmin(){
            if (localStorage.getItem('SIGNAL') == null) return false;
            const CHECK_ROLE_URL = 'http://127.0.0.1:8000/api/auth/role';
            const token = JSON.parse(localStorage.getItem('SIGNAL'))['token'];
            const payload = {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            }
            try {
                const res = await fetch(CHECK_ROLE_URL,payload);
                const data = await res.json();
                return (data.decoded.rol === 'ADMIN');
            } catch (e) {
                console.log(e);
            }
            return null;
        },
        getToken(){
            return JSON.parse(localStorage.getItem('SIGNAL'))['token'];
        },
        deleteSession(){
            localStorage.removeItem('SIGNAL');
        },
    }
}