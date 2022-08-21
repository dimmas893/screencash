import React from 'react'
import { useRecoilValue } from 'recoil'
import App from '../layouts/App'
import { authenticatedUser } from '../stote'

export default function Dashboard() {
    const auth = useRecoilValue(authenticatedUser)
    return (
        <App title="Dashboard">
            <div className="container">
                Welcome to Dashboard {auth.user.name}
            </div>
        </App>
    )
}
