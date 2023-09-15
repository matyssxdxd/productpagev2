import React, { useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'
import axios from "axios";


function AddProduct() {

    const navigate = useNavigate();

    const options = [
        {value: "", text:"Select product type"},
        {value: "DVD", text:"DVD"},
        {value: "Book", text:"Book"},
        {value: "Furniture", text:"Furniture"},
    ];

    const [selected, setSelected] = useState(options[0].value);
    const [inputs, setInputs] = useState({});
    const [attributes, setAttributes] = useState([]);
    const [error, setError] = useState();


    const handleChange=(event: { target: { name: string; value: number | string; }; })=> {
        const name = event.target.name;
        const value = event.target.value;
        if (["weight", "size", "height", "length", "width"].includes(name)) {
            setAttributes(attributes => ({...attributes, [name]: value}));
        } else {
            setInputs(values => ({...values, [name]: value}));
        }
    }

    const handleType=(event: { target: { name: string; value: string } })=>{
        setSelected(event.target.value);
        setAttributes([]);
        handleChange(event);
    }

    const handleSubmit = (event: { preventDefault: () => void; }) => {
        event.preventDefault();
        console.log(inputs);
        console.log(attributes);
        axios.post("http://127.0.0.1:8989/api/addproduct", {inputs, attributes})
        .then(response => {
            if (response.data.status === 0) {
                setError(response.data.message);
            } else {
                navigate("/");
            }
        })
    }

  return (
    <>
    <div className='nav'>
        <h1>Product Add</h1>
        <div className='nav-btn'>
            <button form="product_form">Save</button>
            <Link to="/">
                <button>
                    Cancel
                </button>
            </Link>
        </div>
    </div>
    <div className='form-container'>
        <form id="product_form" onSubmit={handleSubmit}>
            <input type='text' id='sku' name='sku' placeholder='SKU' onChange={handleChange}></input>
            <input type='text' id='name' name='name' placeholder='Name' onChange={handleChange}></input>
            <input type='text' id='price' name='price' placeholder='Price' onChange={handleChange}></input>
            <select value={selected} id="productType" name="type" onChange={handleType}>
                {options.map(option => (
                    <option key={option.value} value={option.value}>
                        {option.text}
                    </option>
                ))}
            </select>
            {selected === "DVD" ? (
                <div className='selected'>
                    <input key="size" type="text" id="size" name="size" placeholder="Size" onChange={handleChange} />
                    <p className="description">Please, provide size</p>
                </div>
            ) : selected === "Book" ? (
                <div className='selected'>
                    <input key="weight" type="text" id="weight" name="weight" placeholder="Weight" onChange={handleChange} />
                    <p className="description">Please, provide weight</p>
                </div>
            ) : selected === "Furniture" ? (
                <div className='selected'>
                    <input key="height" type="text" id="height" name="height" placeholder="Height" onChange={handleChange} />
                    <input key="width" type="text" id="width" name="width" placeholder="Width" onChange={handleChange} />
                    <input key="length" type="text" id="length" name="length" placeholder="Length" onChange={handleChange} />
                    <p className="description">Please, provide dimensions</p>
                </div>
            ) : null}
        </form>
    </div>
    </>
  )
}


export default AddProduct