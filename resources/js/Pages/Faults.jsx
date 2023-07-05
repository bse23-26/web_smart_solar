import React from 'react';
import Main from "@/Layouts/Main";
import {InertiaLink} from "@inertiajs/inertia-react";

const Location = ({location}) => {
  if(location!=null){
    return <a href={"https://maps.google.com?q="+location}><img src="/images/map.png" height="30px" width="30px"/></a>
  }
  return <></>;
}

const Faults = ({faults}) => {
  return (
    <table id="faults">
      <thead>
      <tr>
        <th>Subject</th>
        <th>Description</th>
        <th>Device UUID</th>
        <th>Owner's Email</th>
        <th>Owner's Tel</th>
        <th>Notify Owner</th>
        <th>Locate</th>
        <th>Mark resolved</th>
      </tr>
      </thead>
      <tbody>
      {faults.map((fault)=><tr>
        <td>{fault['subject']}</td>
        <td>{fault['description']}</td>
        <td>{fault['device_uuid']}</td>
        <td><a href={"mailto:"+fault['email']}>{fault['email']}</a></td> {/*make href*/}
        <td>{fault['tel'] ?? 'Null'}</td>
        <td>
          <InertiaLink href={"/notify/"+fault['user_id']} method="GET">
            <ion-icon name="paper-plane"></ion-icon>
          </InertiaLink>
        </td>
        <td><Location location={fault['location']}/></td>
        <td>
          <InertiaLink href={"/faults/"+fault['id']} method="GET">
            <ion-icon name="checkbox-outline"></ion-icon>
          </InertiaLink>
        </td>
      </tr>)}
      </tbody>
    </table>
  );
};

Faults.layout = page => <Main children={page} title="Faults"/>

export default Faults;
