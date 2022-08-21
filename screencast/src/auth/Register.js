import axios from 'axios'
import React, { useState } from 'react'
import { useHistory } from 'react-router-dom'
import App from '../layouts/App'

export default function Register() {
    
    const history = useHistory()
    const [errors, setErrors] = useState([])
    const [name, setName] = useState('')
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const [password_confirmation, setPasswordconfirmation] = useState('')
    let credentials = { name, email, password, password_confirmation }
    const submitHandler = async (e) => {
        e.preventDefault()
        try{
        await axios.post('/register', credentials)
            history.push('/login')
        } catch ({response}) {
            setErrors(response.data.errors)
         }
    }
    return (
        <App title = "Register">
            <div className="container">
                <div className="row">
                    <div className="col-md-4">
                        <div className="card">
                            <div className="card-header">Register</div>
                            <div className="card-body">
                                <form onSubmit={submitHandler}>
                                    
                                    <div className="mb-3">
                                        <label htmlFor="name" className="form-label">Name</label>
                                        <input type="name" value={name} onChange={(e) => setName(e.target.value)} name="name" id="name" className="form-control" />
                                        {errors.name && <div className="text-danger mt-1">{ errors.name[0] }</div> }
                                    </div>
                                    <div className="mb-3">
                                        <label htmlFor="email" className="form-label">Email</label>
                                        <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} name="email" id="email" className="form-control" />
                                        {errors.email && <div className="text-danger mt-1">{ errors.email[0] }</div> }
                                    </div>
                                    <div className="mb-3">
                                        <label htmlFor="password" className="form-label">Password</label>
                                        <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} 
                                            name="password" id="password" className="form-control" />
                                        {errors.password && <div className="text-danger mt-1">{ errors.password[0] }</div> }
                                    </div>
                                    <div className="mb-3">
                                        <label htmlFor="password_confirmation" className="form-label">Confirm Password</label>
                                        <input type="password" value={password_confirmation} onChange={(e) => setPasswordconfirmation(e.target.value)} name="password_confirmation" id="password_confirmation" className="form-control" />
                                    </div>
                                    <button type="submit" className="btn btn-primary">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </App>
    )
}
