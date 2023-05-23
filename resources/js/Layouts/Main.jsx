import {Head} from "@inertiajs/inertia-react";
import {useState} from "react";
import {InertiaLink} from "@inertiajs/inertia-react";


export default function Main({title, children}) {
  useState(title);

  return (
    <>
      <Head title={title}/>
    <div className="container-main">
        <div className="navigation-main">
            <ul>
                <li>
                  <InertiaLink href="dashboard">
                    <span className="icon">
                      <ion-icon name="sunny-outline"></ion-icon>
                    </span>
                    <span className="title">Solar System</span>
                  </InertiaLink>
                </li>

                <li>
                  <InertiaLink href="dashboard">
                    <span className="icon">
                      <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span className="title">Dashboard</span>
                  </InertiaLink>
                </li>

                <li>
                    <a href="{{ route('messages') }}">
                        <span className="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span className="title">Messages</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('Reports') }}">
                        <span className="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span className="title">Reports</span>
                    </a>
                </li>

                {/* <li>
                    <a href="href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span className="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span className="title">Sign Out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" className="d-none">
                        @csrf
                    </form>
                </li> */}
            </ul>
        </div>

        <div className="main">
            <div className="topbar">
                <div className="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div className="search">
                    <label>
                        <input type="text" placeholder="Search here" />
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div className="user">
                    <img src="images/customer01.jpg" alt="" />
                </div>
            </div>

            <div className="cardBox">
                <div className="card-main">
                    <div>
                        <div className="numbers">1,504</div>
                        <div className="cardName">Reports</div>
                    </div>

                    <div className="iconBx">
                        <ion-icon name="clipboard-outline"></ion-icon>
                    </div>
                </div>

                <div className="card-main">
                    <div>
                        <div className="numbers">284</div>
                        <div className="cardName">Messages</div>
                    </div>

                    <div className="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div className="card-main">
                    <div>
                        <div className="numbers">35</div>
                        <div className="cardName">Users</div>
                    </div>

                    <div className="iconBx">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <div className="details">
                <div className="recentOrders">
                    <div className="cardHeader">
                        <h2>Recent reports</h2>
                        <a href="Reports.html" className="btn">View All</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>Client name</td>
                                <td>Report Status</td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Kibirige Mathew</td>
                                <td><span className="status delivered">open</span></td>
                            </tr>

                            <tr>
                                <td>Asiimwe Maria</td>
                                <td><span className="status inProgress">closed</span></td>
                            </tr>

                            <tr>
                                <td>Sansa Atim</td>
                                <td><span className="status inProgress">closed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div className="recentCustomers">
                    <div className="cardHeader">
                        <h2>Recent Customers</h2>
                    </div>

                    <table>
                      <tbody>
                        <tr>
                            <td width="60px">
                                <div className="imgBx"><img src="images/customer02.jpg" alt="" /></div>
                            </td>
                            <td>
                                <h4>Mwesigwa Joshua <br/> <span>Hoima</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div className="imgBx"><img src="images/customer01.jpg" alt=""/></div>
                            </td>
                            <td>
                                <h4>Kibalama Timothy <br/> <span>Mukono</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div className="imgBx"><img src="images/customer02.jpg" alt=""/></div>
                            </td>
                            <td>
                                <h4>Ddamba Mahad  <br/> <span>Wakiso</span></h4>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      {/* <div className="wrapper">
        <Navbar info={{ date:dataDate, setDate:(date)=>{setDataDate(date)} }}/>
        <Sidebar />
        <div className="content-wrapper">
          {children}
        </div>
        <Footer />
      </div> */}
      </div>
    </>
  );
}
