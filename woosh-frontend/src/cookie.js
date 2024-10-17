export function setToken(value, expires = 60){

    localStorage.setItem('token', value)

}

export function getToken(){
    return localStorage.getItem('token')
}

export function clearToken(){
    localStorage.removeItem('token')
}

export async function getSession(){
    const token = getToken();

    try {
        if (token){
            const res = await axios.get("http://127.0.0.1:8000/api/user", {
                headers : {
                    'Authorization' : `Bearer ${token}`
                }
            })

            if(res.status === 404){
                return null
            }

            return res.data
        }

        return null
    } catch (error) {
        return null
    }

}
