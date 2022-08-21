import React, { useEffect, useState } from 'react'
import App from '../../layouts/App'
import axios from 'axios'
import { NavLink } from 'react-router-dom'

export default function Index() {
    const [playlists, setPlaylists] = useState([])
    const [link, SetLinks] = useState([]) 
    const [url, setUrl] = useState('api/playlists') 

    useEffect(() => {
        let isMounted = true
        const getPlaylist = async () => {
            let { data } = await axios.get(url)
            if (isMounted) {
                setPlaylists(data.data)
                SetLinks(data.meta.links)
            }
        }
        getPlaylist()
        return () => { isMounted = false };
    }, [url])
    return (
        <App title="Series">
            <div className="bg-light py-5 mb-5 border-button" style={{ marginTop: '-3rem' }}>
                <div className="container">
                    <h3>All Series</h3>
                    <p className="text-secondary">The latest <strong>series</strong> we have</p>
                </div>
            </div>

            <div className="container">
                <div className="row">
                {playlists.map((playlist, index) => (
                    <div className="col-md-4" key={index}>
                        <div className="card mb-4">
                            <img src={playlist.picture} alt={playlist.name} height="200" width="100" className="card-img-top" />
                            <div className="card-body">
                                <h5>
                                    <NavLink to={`/series/${playlist.slug}`} className="text-decoration-none">
                                         {playlist.name}
                                    </NavLink>
                                </h5>
                                <div className="d-flex align-items-center justify-content-between">
                                    <span className="text-secondary">
                                        {playlist.videos} Episode
                                    </span>
                                    <span className="text-secondary">
                                       Rp {playlist.price.formatted} Harga
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                ))}
                
                <nav aria-label="Page navigation example">
                    <ul className="pagination">
                        {link.length > 3 && link.map((link, index) => (
                            <li className={`page-item ${link.active && 'active'}`} key={index}>
                                <button className="page-link" onClick={() => setUrl(link.url)} dangerouslySetInnerHTML={{__html: link.label}}></button>
                            </li>
                        ))}
                    </ul>
                </nav>
            </div>
            </div>
        </App>
    )
}
