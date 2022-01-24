import React, { useState, useEffect }  from 'react';
import queryString from 'query-string';
import Select from 'react-dropdown-select';
import "@reach/combobox/styles.css";
import './App.css';

const App = () => {
  const [error, setError] = useState(null);
  const [isLoaded, setIsLoaded] = useState(false);
  const [phoneNumbers, setPhoneNumbers] = useState([]);
  const [selectCountryOption, setSelectCountryOption] = useState();
  const [selectStateOption, setSelectStateOption] = useState();

  const countryOptions = [
    { value: 'cameroon', label: 'Cameroon', code: '237' },
    { value: 'ethiopia', label: 'Ethiopia', code: '251' },
    { value: 'morocco', label: 'Morocco', code: '212' },
    { value: 'mozambique', label: 'Mozambique', code: '258' },
    { value: 'uganda', label: 'Uganda', code: '256' },
  ]

  const stateOptions = [
    { value: 'OK', label: 'Valid phone numbers'},
    { value: 'NOK', label: 'Invalid phone numbers'},
  ]

  const getQueryString = () => {
    if (!selectStateOption && !selectCountryOption) {
      return ''
    }

    return queryString.stringify({
      code: selectCountryOption?.code,
      state: selectStateOption?.value,
    });
  }

  useEffect(() => {
      const qs = getQueryString()
      fetch(`http://localhost:8080/phone-numbers?${qs}`)
          .then(res => res.json())
          .then(
              (data) => {
                  setIsLoaded(true);
                  setPhoneNumbers(data);
                  console.log(phoneNumbers)
              },
              (error) => {
                  setIsLoaded(true);
                  setError(error);
              }
          )
    }, [selectCountryOption, selectStateOption])

  if (!isLoaded) {
    return <div>Loading...</div>;
  }

  return (
    <div className="App">
      <h1>Phone numbers</h1>

      <div className='filters'>
        <div className='filter'>
          <Select
            placeholder='Select a country'
            options={countryOptions}
            values={[]}
            onChange={(value) => setSelectCountryOption(value[0])}
          />
        </div>

        {console.log(phoneNumbers)}

        <div className='filter'>
          <Select
            placeholder='Select a state'
            options={stateOptions}
            values={[]}
            onChange={(value) => setSelectStateOption(value[0])}
          />
        </div>
      </div>

      <div className='center'>
        <table>
          <thead>
            <tr>
            <th>Country</th>
            <th>State</th>
            <th>Country code</th>
            <th>Phone number</th>
            </tr>
          </thead>
          <tbody>
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
          </tbody>
        </table>
      </div>
    </div>
  );


}

export default App;
