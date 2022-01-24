import React, { useState, useEffect }  from 'react';
import './App.css';

const App = () => {
  const [error, setError] = useState(null);
  const [isLoaded, setIsLoaded] = useState(false);
  const [phoneNumbers, setPhoneNumbers] = useState([]);
  useEffect(() => {
      fetch("http://localhost:8080/phone-numbers", { mode: 'no-cors' })
          .then(res => res.json())
          .then(
              (data) => {
                  setIsLoaded(true);
                  setPhoneNumbers(data);
              },
              (error) => {
                  console.log(error);
                  setIsLoaded(true);
                  setError(error);
              }
          )
    }, [])

  if (!isLoaded) {
    return <div>Loading...</div>;
  } else {
    return (
      <div className="App">
        {/* <h1>Phone numbers</h1>
        <table>
          <tr>
            <th>Country</th>
            <th>State</th>
            <th>Country code</th>
            <th>Phone number</th>
          </tr>
          {phoneNumbers.map((val, key) => {
            return (
              <tr key={key}>
                <td>{val.country}</td>
                <td>{val.state}</td>
                <td>+{val.country_code}</td>
                <td>{val.phone_number}</td>
              </tr>
            )
          })}
        </table> */}
      </div>
    );
  }


}

export default App;
