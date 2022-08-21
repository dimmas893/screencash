import React from 'react'
import App from '../../layouts/App'
import axios from 'axios'
import { useParams } from 'react-router'
import toaster from "toasted-notes";
import "toasted-notes/src/styles.css";
import { useSetRecoilState } from 'recoil';
import { aNumberOfCart } from '../../stote';
import { NavLink } from 'react-router-dom';
import Lesson from '../../components/Lesson';
import usePlaylist from '../hooks/usePlaylist';

export default function Show() {
    const setaNumberOfCart = useSetRecoilState(aNumberOfCart)
    const {slug} = useParams()
    // const [playlist, setPlaylist] = useState([])
    const {playlist, lessons, hasBought} = usePlaylist(slug)
    const addtocarthandler = async () => {
        try {
            let { data } = await axios.post(`api/add-to-cart/${playlist.slug}`)
            toaster.notify(data.message, { position: 'bottom-right' })
            // push keranjang
            setaNumberOfCart(cart => [...cart, data.data])
        } catch (error) {
            toaster.notify(error.response.data.message, {position: 'bottom-right'})
        }
        
    }
   
    return (
        <App title="Series">
            <div className="bg-light py-5 mb-5 border-buttom" style={{ marginTop: '-3rem' }}> 
                <div className="container">
                    <div className="col-md-6">
                        <h1>{playlist.name}</h1>
                        <p className="text-secondary">
                            {playlist.description}
                        </p>
                        <div className="mt-4">
                            <NavLink to={`/series/${playlist.slug}/1`} className="btn btn-secondary me-2">Watch</NavLink>
                            {!hasBought &&
                             <button onClick={addtocarthandler} className="btn btn-primary">Add to cart</button> 
                            }
                        </div>
                    </div>
                </div>
            </div>

            <div className="container">
                <div className="row">
                    <div className="col-md-6">
                        <div className="card" style={{marginTop: -80}}>
                            <div className="card-header bg-white border-bottom py-3">
                                 {playlist.name}
                            </div>

                            <div className="card-body">
                                <Lesson playlist={playlist.slug} lessons={lessons}/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </App>
    )
}
