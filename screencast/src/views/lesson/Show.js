import axios from 'axios'
import React, { useEffect, useState } from 'react'
import { useParams } from 'react-router'
import YouTube from 'react-youtube';
import Lesson from '../../components/Lesson';
import App from '../../layouts/App';
import usePlaylist from '../hooks/usePlaylist';

export default function Show() {
    const { episode, slug } = useParams()
    const {playlist, lessons, hasBought} = usePlaylist(slug)
    const [lesson, setLesson] = useState([])
    const [errorScreen, seterrorScreen] = useState(false)
    const onReady = () => {
        console.log('Video from youtube is ready to watch')
    }
    useEffect(() => {
        const getLesson = async () => {
            try{
                const {data} = await axios.get(`api/playlists/${slug}/${episode}`)
                setLesson(data.data);
            } catch (e) {
                seterrorScreen(true)
                }
        }
        getLesson()
    }, [episode, slug])
    return (
        <App title={lesson.title}>
            <div className="bg-dark mb-5" style={{marginTop: '-48px'}}>
                <div className="container">
                    {hasBought && !errorScreen && (
                    <YouTube
                        videoId={lesson.unique_video_id}
                        className={``}
                        containerClassName={'ratio ratio-16x9'}   
                        onReady={onReady}
                        />
                    )}

                    {!hasBought && lesson.intro && !errorScreen(
                    <YouTube
                        videoId={lesson.unique_video_id}
                        className={``}
                        containerClassName={'ratio ratio-16x9'}   
                        onReady={onReady}
                        />
                    )}


                    {errorScreen && <div className="text-white p-5">
                        <div className="container">
                            you have to buy if you want to watch!
                        </div>
                    </div>}
                </div>
            </div> 

                <div className="container">
                <div className="row">
                    <div className="col-md-6">
                        <div className="card">
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
