import React from 'react'
import { BrowserRouter, Switch, Route } from 'react-router-dom'
import Login from '../auth/Login'
import Register from '../auth/Register'
import Dashboard from '../views/Dashboard'
import Home from '../views/Home'
import * as middleware from '../middleware'
import * as series from '../views/playlists/App'
import * as lesson from '../views/lesson/App'
import Cart from '../views/orders/Cart'
import PaymentSuccess from '../views/PaymentSuccess'

export default function ReactRouter() {
    return (
        <BrowserRouter>
            <Switch>
                <Route exact path="/" component={Home} />
                <Route exact path="/series" component={series.Index} />
                <Route exact path="/series/:slug" component={series.Show} />
                <Route path="/series/:slug/:episode" component={lesson.show} />
                
                <Route path="/login">
                    <middleware.Guest render={<Login />}/>
                </Route>

                <Route path="/register">
                     <middleware.Guest render={<Register />}/>
                </Route>

                <Route path="/dashboard">
                    <middleware.Authenticated render={<Dashboard />}/>
                </Route>

                <Route exact path="/your-cart">
                    <middleware.Authenticated render={<Cart />}/>
                </Route>

                <Route path="/your-payment-success">
                    <middleware.Authenticated render={<PaymentSuccess />}/>
                </Route>
            </Switch>
        </BrowserRouter>   
    )
}
