import React from 'react'
import { Link } from 'react-router-dom'

function Home() {
  return (
    <>
    <div className='nav'>
        <h1>Product List</h1>
        <div className='nav-btn'>
            <Link to="/addproduct">
                <button>ADD</button>
            </Link>
            <button>
                MASS DELETE
            </button>
        </div>
    </div>
    <div className='item-container'></div>
    </>
  )
}

export default Home