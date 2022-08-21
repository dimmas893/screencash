import React from 'react'
import App from '../layouts/App'

export default function PaymentSuccess() {
    return (
        <App>
            <div className="container">
                <div className="row">
                    <div className="col-md-6">
                       <div className="alert alert-success">
                        Thank for buying
                        </div>
                    </div>
                </div>
            </div>
        </App>
    )
}
