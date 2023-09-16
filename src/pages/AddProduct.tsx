import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import axios from "axios";
import "./AddProduct.css";

function AddProduct() {
  const navigate = useNavigate();

  const options = [
    { value: "", text: "Select product type" },
    { value: "DVD", text: "DVD" },
    { value: "Book", text: "Book" },
    { value: "Furniture", text: "Furniture" },
  ];

  const [selected, setSelected] = useState(options[0].value);
  const [inputs, setInputs] = useState({});
  const [attributes, setAttributes] = useState({});
  const [error, setError] = useState();

  const handleChange = (event: {
    target: { name: string; value: number | string };
  }) => {
    const name = event.target.name;
    const value = event.target.value;
    if (["weight", "size", "height", "length", "width"].includes(name)) {
      setAttributes((attributes) => ({ ...attributes, [name]: value }));
    } else {
      setInputs((values) => ({ ...values, [name]: value }));
    }
  };

  const handleType = (event: { target: { name: string; value: string } }) => {
    setSelected(event.target.value);
    setAttributes({});
    handleChange(event);
  };

  const handleSubmit = (event: { preventDefault: () => void }) => {
    event.preventDefault();
    axios
      .post(
        "http://127.0.0.1:8989/api/addproduct",
        document.querySelector("#product_form")
      )
      .then(() => {
        navigate("/");
      })
      .catch((error) => {
        setError(error.response.data.message);
      });
  };

  return (
    <div className="container">
      <div className="nav">
        <h1>Product Add</h1>
        <div className="nav-btns">
          <button form="product_form" className="nav-btn">SAVE</button>
          <Link to="/" className="nav-btn">CANCEL</Link>
        </div>
      </div>
      <hr />
      <div className="form-container">
        {error !== "" ? <div className="error-message">{error}</div> : null}
        <form id="product_form" onSubmit={handleSubmit}>
          <input
            type="text"
            id="sku"
            name="sku"
            placeholder="SKU"
            onChange={handleChange}
          />
          <input
            type="text"
            id="name"
            name="name"
            placeholder="Name"
            onChange={handleChange}
          />
          <input
            type="text"
            id="price"
            name="price"
            placeholder="Price"
            onChange={handleChange}
          />
          <select
            value={selected}
            id="productType"
            name="type"
            onChange={handleType}
          >
            {options.map((option) => (
              <option key={option.value} value={option.value}>
                {option.text}
              </option>
            ))}
          </select>
          {selected === "DVD" ? (
            <div className="selected">
              <input
                key="size"
                type="text"
                id="size"
                name="size"
                placeholder="Size"
                onChange={handleChange}
              />
              <p className="description">Please, provide size</p>
            </div>
          ) : selected === "Book" ? (
            <div className="selected">
              <input
                key="weight"
                type="text"
                id="weight"
                name="weight"
                placeholder="Weight"
                onChange={handleChange}
              />
              <p className="description">Please, provide weight</p>
            </div>
          ) : selected === "Furniture" ? (
            <div className="selected">
              <input
                key="height"
                type="text"
                id="height"
                name="height"
                placeholder="Height"
                onChange={handleChange}
              />
              <input
                key="width"
                type="text"
                id="width"
                name="width"
                placeholder="Width"
                onChange={handleChange}
              />
              <input
                key="length"
                type="text"
                id="length"
                name="length"
                placeholder="Length"
                onChange={handleChange}
              />
              <p className="description">Please, provide dimensions</p>
            </div>
          ) : null}
        </form>
      </div>
      <hr />
      <div className="footer">
        Scandiweb Test assignment
      </div>
    </div>
  );
}

export default AddProduct;
