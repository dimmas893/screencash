import { useHistory } from 'react-router-dom'
import { useRecoilValue } from 'recoil'
import { authenticatedUser } from '../stote'

export default function Guest(props) {
    
    const auth = useRecoilValue(authenticatedUser)
    const history = useHistory()
    if (auth.check) { 
        history.push('/dashboard')
    }
    return props.render
}
