import React from 'react';
import Main from "@/Layouts/Main";
import {InertiaLink} from "@inertiajs/inertia-react";

const Location = ({location}) => {
  if(location!=null){
    return <a href={"https://maps.google.com?q="+location}><img src="/images/map.png" height="30px" width="30px"/></a>
  }
  return <></>;
}

const Notify = ({id}) =>{
  if(id!=null){
    return <InertiaLink href={"/notify/"+id} method="GET">
      <ion-icon name="paper-plane"></ion-icon>
    </InertiaLink>
  }
  return <></>
}
const Devices = ({devices}) => {
  return (
    <table id="devices">
      <thead>
      <tr>
        <th>Device UUID</th>
        <th>Locate</th>
        <th>Last Seen</th>
        <th>Owner's Email</th>
        <th>Owner's Tel</th>
        <th>Notify Owner</th>
      </tr>
      </thead>
      <tbody>
      {devices.map((device)=><tr>
        <td>{device['device_uuid']}</td>

        <td><Location location={device['location']}/></td>
        <td>{device['last_seen'] ?? ''}</td>
        <td><a href={"mailto:"+device['email']}>{device['email']}</a></td>
        <td>{device['tel'] ?? ''}</td>
        <td><Notify id={device['user_id']} /></td>
      </tr>)}
      </tbody>
    </table>
  );
};

Devices.layout = page => <Main children={page} title="Devices"/>

export default Devices;
