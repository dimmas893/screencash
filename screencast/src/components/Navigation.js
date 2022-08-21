import axios from 'axios'
import React from 'react'
import { NavLink } from 'react-router-dom'
import { useRecoilState, useRecoilValue } from 'recoil'
import { aNumberOfCart, authenticatedUser } from '../stote'
import { useHistory } from 'react-router-dom';

export default function Navigation() {
  
  const history = useHistory()
  const totalCart = useRecoilValue(aNumberOfCart)
  const [auth, setAuth] = useRecoilState(authenticatedUser)
  const logoutHandler = async () => {
    await axios.post('/logout')
    setAuth({
      check: false,
      user: [],
    })
    history.push('/login')
  }

    return (
<nav className="navbar navbar-expand-lg navbar-dark bg-primary border-bottom py-3">
  <div className="container">
    <NavLink className="navbar-brand" to="/">Screencast</NavLink>
    <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span className="navbar-toggler-icon" />
    </button>
    <div className="collapse navbar-collapse" id="navbarSupportedContent">
      <ul className="navbar-nav me-auto mb-2 mb-lg-0">
        <li className="nav-item">
          <NavLink className="nav-link" exact to="/">Home</NavLink>
        </li>
        <li className="nav-item">
          <NavLink className="nav-link" to="/series">Series</NavLink>
        </li>
              {/* {auth.check &&
                <li className="nav-item">
                   <NavLink className="nav-link" to="/dashboard">Dashboard</NavLink>
                </li>
              } */}
      </ul> 
            {auth.check ?
              <ul className="navbar-nav mb-2 mb-lg-0">
                <li className="nav-item">
                    <a href="/your-cart" className="nav-link d-flex align-items-center" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                          <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                       </svg>
                    <span className="ms-2">{ totalCart.length }</span>
                    </a>
                </li>

                <li className="nav-item dropdown">
                  <NavLink className="nav-link dropdown-toggle" to="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {auth.user.name}
                  </NavLink>
                  <ul className="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><button className="dropdown-item" onClick={logoutHandler}>Log Out</button></li>
                  </ul>
                </li>
              </ul>

                  :
              
              <ul className="navbar-nav mb-2 mb-lg-0">
                <li className="nav-item">
                  <NavLink to="/login" className="nav-link">Login</NavLink>
                </li>
                <li className="nav-item">
                  <NavLink className="nav-link" to="/register">Register</NavLink>
                </li>
              </ul>
            }
    </div>
  </div>
</nav>
    )
}
