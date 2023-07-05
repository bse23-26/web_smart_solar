import { useState} from 'react';
import Main from "@/Layouts/Main";
import { router } from '@inertiajs/react'

const Mess = ({message}) => {
  return message==null?<></>:<span style={{"padding":"10px", "borderRadius":"5px"}} className="bg-success">{message}</span>
}
const Notify = ({id, message}) => {
  const [values, setValues] = useState({
    subject: "",
    description: "",
    id: id,
  })

  function handleChange(e) {
    const key = e.target.id;
    const value = e.target.value
    setValues(values => ({
      ...values,
      [key]: value,
    }))
  }


  function handleSubmit(e) {
    e.preventDefault()
    router.post('/notify', values)
  }

  return (
    <div style={{"paddingLeft": "20px", "paddingTop": "10px", }}>
      <Mess message={message}/>
      <br/><br/>
      <form onSubmit={handleSubmit}>
        <input value={values.subject} id="subject" onChange={handleChange} placeholder="subject" size="50"/>
        <br/><br/>
        <textarea value={values.description} id="description" onChange={handleChange} placeholder="description" rows="8" cols="54">
        </textarea>
        <br/>
        <input id="id" value={values.id} hidden="hidden" />
        <br/>
        <button type="submit" className="btn btn-primary">Submit</button>
      </form>
    </div>
  )
}

Notify.layout = page => <Main children={page} title="Notify"/>

export default Notify;
