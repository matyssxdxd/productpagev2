import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import axios from "axios";
import "./AddProduct.css";

interface Inputs {
  sku: string,
  name: string,
  price: number | string,
  type: string
}

interface Attributes {
  size: number | string,
  weight: number | string,
  height: number | string,
  width: number | string,
  length: number | string,
}

function AddProduct() {
  const navigate = useNavigate();

  const options = [
    { value: "", text: "Select product type" },
    { value: "DVD", text: "DVD" },
    { value: "Book", text: "Book" },
    { value: "Furniture", text: "Furniture" },
  ];

  const [selected, setSelected] = useState<string>(options[0].value);
  const [inputs, setInputs] = useState<Inputs>({
    sku: "",
    name: "",
    price: "",
    type: ""
  });
  const [attributes, setAttributes] = useState<Attributes>({
    size: "",
    weight: "",
    height: "",
    width: "",
    length: ""
  });
  const [error, setError] = useState<string>();

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
    setAttributes({
      size: "",
      weight: "",
      height: "",
      width: "",
      length: ""
    });
    handleChange(event);
  };

  const handleSubmit = (event: { preventDefault: () => void }) => {
    event.preventDefault();
    axios
      .post(
        "https://productpagematyss.x10.mx/api/addproduct",
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
          <button type="submit" form="product_form" className="nav-btn">Save</button>
          <Link to="/" className="nav-btn">Cancel</Link>
      </div>
      <hr />
      <div className="form-container">
        {error !== "" ? <div className="error-message">{error}</div> : null}
        <form id="product_form" onSubmit={handleSubmit}>
          <input
            value={inputs.sku}
            type="text"
            id="sku"
            name="sku"
            placeholder="SKU"
            onChange={handleChange}
          />
          <input
            value={inputs.name}
            type="text"
            id="name"
            name="name"
            placeholder="Name"
            onChange={handleChange}
          />
          <input
            value={inputs.price}
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
                value={attributes.size}
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
                value={attributes.weight}
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
                value={attributes.height}
                key="height"
                type="text"
                id="height"
                name="height"
                placeholder="Height"
                onChange={handleChange}
              />
              <input
                value={attributes.width}
                key="width"
                type="text"
                id="width"
                name="width"
                placeholder="Width"
                onChange={handleChange}
              />
              <input
                value={attributes.length}
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
