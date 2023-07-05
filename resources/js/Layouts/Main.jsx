import {useState} from "react";
import {InertiaLink, Head, usePage} from "@inertiajs/inertia-react";


export default function Main({title, children}) {
  useState(title);
  const { auth } = usePage().props
  return (
    <>
      <Head title={title}/>
      <div className="container-main">
        <div className="navigation-main">
          <ul>
            <div style={{
              position: "relative",
              display: "block",
              padding: "5px 20px",
              whiteSpace: "nowrap",
              color: "white"
            }}>
              <span className="imgBx">
                <img src="/images/customer01.jpg" alt="" width="40px" height="40px" style={{borderRadius: "50px", overflow: 'hidden'}}/>
              </span> &nbsp;
              <span style={{fontSize: "20px"}}>{auth.user.name}</span>
              <br/>
              <span style={{fontSize: "18px"}}>{auth.user.email}</span>
              <br/>
            </div>

            <li>
              <InertiaLink href="logout" method="POST">
                    <span className="icon">
                      <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                <span className="title">Logout</span>
              </InertiaLink>
            </li>
            <br/>

            <li>
              <InertiaLink href="/dashboard">
                    <span className="icon">
                      <ion-icon name="home-outline"></ion-icon>
                    </span>
                <span className="title">Dashboard</span>
              </InertiaLink>
            </li>

            <li>
              <InertiaLink href="/faults">
                        <span className="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                <span className="title">Faults</span>
              </InertiaLink>
            </li>

            <li>
              <InertiaLink href="/devices">
                        <span className="icon">
                          <img src="/images/logo.png" height="35px" width="40px" alt=""/>
                        </span>
                <span className="title">Devices</span>
              </InertiaLink>
            </li>
          </ul>
        </div>

        <div className="main">
          {children}
        </div>
      </div>
    </>
  );
}
