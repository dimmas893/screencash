import axios from 'axios'
import React, { useEffect, useState } from 'react'
import { useSetRecoilState } from 'recoil'
import ReactRouter from './router'
import { aNumberOfCart, authenticatedUser } from './stote'

export default function App() {
  const [mounted, setMounted] = useState(false)
  const setAuth = useSetRecoilState(authenticatedUser)
  const setaNumberOfCart = useSetRecoilState(aNumberOfCart)
  useEffect(() => {
    const getUser = async () => {
      setMounted(false)
      try {
          let { data } = await axios.get('api/me')
          setAuth({ user: data.data, check: true })
          setMounted(true)
      } catch {   
          setMounted(true)
          console.log('You are not log in');
      }
    }
    
    const getCarts = async () => {
      let { data } = await axios.get('api/carts')
      setaNumberOfCart(data.data)
    }
    getUser()
    getCarts()

  }, [setAuth])

  if (!mounted) {
    return <div className="d-flex justify-content-center align-items-center min-vh-100">Loading. . . .</div>
  }

  return (
    <div>
        <ReactRouter/>  
    </div>
  )
}
