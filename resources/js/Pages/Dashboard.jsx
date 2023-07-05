import React from 'react';
import Main from "@/Layouts/Main";

const Dashboard = ({user_count, device_count, fault_count}) => {

  return (
    <>
      <div className="cardBox">
        <div className="card-main">
          <div>
            <div className="numbers">{user_count}</div>
            <div className="cardName">Users</div>
          </div>

          <div className="iconBx">
            <ion-icon name="people-outline"></ion-icon>
          </div>
        </div>

        <div className="card-main">
          <div>
            <div className="numbers">{device_count}</div>
            <div className="cardName">Devices</div>
          </div>

          <div className="iconBx">
            <img src="images/logo.png" height="60px" width="60px" alt=""/>
          </div>
        </div>

        <div className="card-main">
          <div>
            <div className="numbers">{fault_count}</div>
            <div className="cardName">Faults</div>
          </div>

          <div className="iconBx">
            <ion-icon name="settings-outline"></ion-icon>
          </div>
        </div>
      </div>

      <div className="details" style={{display: 'block'}} hidden="hidden">
        <div className="recentOrders" style={{width: "100%"}}>
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

        {/*<div className="recentCustomers">*/}
        {/*  <div className="cardHeader">*/}
        {/*    <h2>Recent Customers</h2>*/}
        {/*  </div>*/}

        {/*  <table>*/}
        {/*    <tbody>*/}
        {/*    <tr>*/}
        {/*      <td width="60px">*/}
        {/*        <div className="imgBx"><img src="images/customer02.jpg" alt="" /></div>*/}
        {/*      </td>*/}
        {/*      <td>*/}
        {/*        <h4>Mwesigwa Joshua <br/> <span>Hoima</span></h4>*/}
        {/*      </td>*/}
        {/*    </tr>*/}

        {/*    <tr>*/}
        {/*      <td width="60px">*/}
        {/*        <div className="imgBx"><img src="images/customer01.jpg" alt=""/></div>*/}
        {/*      </td>*/}
        {/*      <td>*/}
        {/*        <h4>Kibalama Timothy <br/> <span>Mukono</span></h4>*/}
        {/*      </td>*/}
        {/*    </tr>*/}

        {/*    <tr>*/}
        {/*      <td width="60px">*/}
        {/*        <div className="imgBx"><img src="images/customer02.jpg" alt=""/></div>*/}
        {/*      </td>*/}
        {/*      <td>*/}
        {/*        <h4>Ddamba Mahad  <br/> <span>Wakiso</span></h4>*/}
        {/*      </td>*/}
        {/*    </tr>*/}
        {/*    </tbody>*/}
        {/*  </table>*/}
        {/*</div>*/}
      </div>
    </>
  );
};

Dashboard.layout = page => <Main children={page} title="Dashboard"/>

export default Dashboard;
