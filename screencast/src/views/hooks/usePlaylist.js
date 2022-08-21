import axios from "axios"
import { useEffect, useState } from "react"


export default function usePlaylist(identifier) {
    const [playlist, setPlaylist] = useState([])
    const [lessons, setLessons] = useState([])
    const [hasBought, setHasBought] = useState(false)

    useEffect(() => {
        const getPlaylist = async () => {
            const { data } = await axios.get(`api/playlists/${identifier}/videos`)
            setPlaylist(data.playlist)
            setLessons(data.data)
        }

        const chackIfUserHasbought = async () => {   
            const { data } = await axios.get(`api/check-if-user-has-bought-the-series-${identifier}`)
            setHasBought(data.data)
        }
 chackIfUserHasbought()
        getPlaylist()
    }, [identifier])
    return {
      playlist, lessons, hasBought
    }
}
